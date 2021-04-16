<?php

namespace App\Form;

use App\Entity\ArticleTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', ArticleTranslationType::class, ['label' => false, 'data' => new ArticleTranslation(), 'mapped' => false, 'property_path' => 'translations[0]'])
            ->add('publishedAt', DateTimeType::class, ['label' => 'Published At', 'data' => new \DateTime(), 'date_widget' => 'single_text', 'time_widget' => 'single_text', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Save']);

        if($builder->has('translations')) {
            $builder->get('translations')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $entity = $event->getForm()->getParent()->getData();
                $translation = $event->getData();
                $translation->setLocale('de');
                $entity->addTranslation($translation);
            });
        }
    }
}