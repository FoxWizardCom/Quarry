<?php

namespace StoryBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use DoctrineTest\InstantiatorTestAsset\WakeUpNoticesAsset;
use StoryBundle\Entity\Chapter;
use StoryBundle\Entity\Checkpoint;
use StoryBundle\Entity\Hint;
use StoryBundle\Entity\Mission;
use StoryBundle\Entity\Progression;
use StoryBundle\Entity\Story;
use StoryBundle\Entity\UserStory;
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
        $em = $this->getDoctrine();

        $story = $em->getRepository('StoryBundle:Story')
            ->find($storyId);

        $userStory = $em->getRepository('StoryBundle:UserStory')
            ->findOneBy(array('user' => $this->getUser(), 'story' => $story));


        $progressions = new ArrayCollection();
        if($userStory != null) {
            $progressions = $userStory->getProgressions();
        }else{
            $userStory = new UserStory();
            $userStory->setUser($this->getUser());
            $userStory->setStory($story);

            foreach ($story->getChapters() as $chapter){
                $progression = new Progression($userStory, $chapter, null, null, 0, 0);
                $progression->setUserStory($userStory);
                $progressions->add($progression);
                foreach($chapter->getMissions() as $mission){
                    $progression = new Progression($userStory, $chapter, $mission, null,0 , 0);
                    $progression->setUserStory($userStory);
                    $progressions->add($progression);
                    if($mission != null) {
                        foreach ($mission->getCheckpoints() as $checkpoint) {
                            $progression = new Progression($userStory, $chapter, $mission, $checkpoint, 0, 0);
                            $progression->setUserStory($userStory);
                            $progressions->add($progression);
                        }
                    }
                }
            }
            $userStory->setProgressions($progressions);

           $manager = $this->getDoctrine()->getManager();
               $manager->persist($userStory);
               $manager->flush();
        }

        return $this->render('StoryBundle:Default:story.html.twig', array('story' => $story, 'progressions' => $progressions));
    }

    /**
     * @Route("/ajax", name="ajax", options={"expose"=true})
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function ajaxAction(Request $request)
    {
        $array = json_decode($request->getContent());

        $progression = new Progression($array->{"id"},$array->{"chapterId"},$array->{"missionId"},$array->{"checkpointId"},$array->{"timeStarted"},$array->{"timeFinished"});

       /* $em = $this->getDoctrine()->getManager();
        $em->persist($progression);
        $em->flush();*/

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => 'this is a json response'));
        }

        return new Response('This is not ajax!', 400);
    }
}
