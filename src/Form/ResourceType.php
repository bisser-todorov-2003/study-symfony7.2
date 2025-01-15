<?php

namespace App\Form;

use App\Entity\Resource;
use App\Entity\Topic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('topic', EntityType::class, [
                'class' => Topic::class,
                'choice_label' => 'name',
            ])
            ->add('name')
            ->add('author')
            ->add('link')
            ->add('note')
            ->add('type')
            ->add('size')
            ->add('startDate', null, [
                'widget' => 'single_text',
            ])
            ->add('finishDate', null, [
                'widget' => 'single_text',
            ])
            ->add('progress')
            ->add('submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}
