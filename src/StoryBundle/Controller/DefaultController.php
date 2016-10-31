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
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/story")
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
        $chapter = new Chapter();
        $mission = new Mission();
        $checkpoint = new Checkpoint();
        $hint = new Hint();

        $checkpoint->addStoryPart($hint);
        $mission->addStoryPart($checkpoint);
        $chapter->addStoryPart($mission);
        $story->addStoryPart($chapter);

        $form = $this->createForm(StoryType::class, $story);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($story);
            $em->persist($chapter);
            $em->flush();

            return $this->render('StoryBundle:Default:form.html.twig', array('form' => $form->createView() ) );
        }
       return $this->render('StoryBundle:Default:form.html.twig', array('form' => $form->createView()) );
}

    /**
     * @Route("/story/map")
     */
    public function mapAction()
    {
        return $this->render('StoryBundle:Default:map.html.twig');
    }
}
