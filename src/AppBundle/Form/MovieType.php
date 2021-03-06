<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MovieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('label');
        $builder->add('sublabel');
        $builder->add('description');
        $builder->add('year');
        $builder->add('enabled');
        $builder->add('comment');
        $builder->add('imdb');
        $builder->add('classification');
        $builder->add('playas', ChoiceType::class, array(
            'choices' => array(
                "Free" => 1,
                "Premuim" => 2,
                "Unlock with rewards Ads" => 3
            )));
        $builder->add('downloadas', ChoiceType::class, array(
            'choices' => array(
                "Free" => 1,
                "Premuim" => 2,
                "Unlock with rewards Ads" => 3
            )));
        $builder->add('duration');
        $builder->add('tags');
        $builder->add('sourcetype', ChoiceType::class, array(
            'choices' => array(
                "Youtube Url" => 1,
                "m3u8 Url" => 2,
                "MOV Url" => 3,
                "MP4 Url" => 4,
                "MKV Url" => 6,
                "WEBM Url" => 7,
                "Embed source" => 8,
                "File (MP4/MOV/MKV/WEBM)" => 5
            )));
        $builder->add('sourceurl');
        $builder->add("sourcefile", null, array("label" => "", "required" => false));
        $builder->add('trailerurl');
        $builder->add("genres", EntityType::class,
            array(
                'class' => 'AppBundle:Genre',
                'expanded' => true,
                "multiple" => "true",
                'by_reference' => false
            )
        );
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $article = $event->getData();
            $form = $event->getForm();
            if ($article and null !== $article->getId()) {
                $form->add("fileposter", null, array("label" => "", "required" => false));
                $form->add("filecover", null, array("label" => "", "required" => false));
            } else {
                $form->add("fileposter", null, array("label" => "", "required" => false));
                $form->add("filecover", null, array("label" => "", "required" => false));
            }
        });
        $builder->add('save', SubmitType::class, array("label" => "SAVE"));

    }

    public function getName()
    {
        return 'movie';
    }
}