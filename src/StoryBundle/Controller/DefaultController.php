<?php

namespace StoryBundle\Controller;

use StoryBundle\Entity\Chapter;
use StoryBundle\Entity\Checkpoint;
use StoryBundle\Entity\Hint;
use StoryBundle\Entity\Mission;
use StoryBundle\Entity\Story;
use StoryBundle\Form\ChapterType;
use StoryBundle\Form\StoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('StoryBundle:Default:index.html.twig');
    }

    /**
     * @Route("/story/create")
     */
    public function createStoryAction(Request $request)
    {
        $story = new Story();

        $form = $this->createForm(StoryType::class, $story);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $story->setAuthor($this->getUser());

            foreach ($story->getChapters() as $chapter){
                $chapter->setStory($story);
                foreach($chapter->getMissions() as $mission){
                    $mission->setStoryParent($chapter);
                    foreach($mission->getCheckpoints() as $checkpoint){
                        $checkpoint->setStoryParent($mission);
                        foreach($checkpoint->getHints() as $hint){
                            $hint->setStoryParent($checkpoint);
                        }
                    }

                }
            }
            $em->persist($story);
            $em->flush();

            return $this->redirectToRoute('story', array('storyId' => $story->getId()));
        }
       return $this->render('StoryBundle:Default:form.html.twig', array('form' => $form->createView()) );
}

    /**
     * @Route("/story/list")
     */
    public function storyListAction()
    {
        $stories = $this->getDoctrine()
            ->getRepository('StoryBundle:Story')
            ->findAll();

        if (!$stories) {
            throw $this->createNotFoundException(
               'no stories found!'
            );
        }
        return $this->render('StoryBundle:Default:storylist.html.twig', array('stories' => $stories));
    }

    /**
     * @Route("/story/{storyId}", name="story")
     */
    public function storyAction($storyId)
    {
        $story = $this->getDoctrine()
            ->getRepository('StoryBundle:Story')
            ->find($storyId);

        return $this->render('StoryBundle:Default:story.html.twig', array('story' => $story));
    }

    /**
     * @Route("/ajax", name="ajax", options={"expose"=true})
     * @param Request $request
     * @return JsonResponse|Response
     *
     */
    public function ajaxAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => 'this is a json response'));
        }

        return new Response('This is not ajax!', 400);
    }
}
