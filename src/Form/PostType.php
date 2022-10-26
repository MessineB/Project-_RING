<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'required' => false,
                'attr' => array(
                    'class' => "testform"
                ),
            ] )
            ->add('public' , TextType::class , [
                'required' => true,
                'label' => 'Public ciblé',
                'attr' => array(
                    'placeholder' => 'Public ciblé',
                    'class' => "testform"),
                
            ])
            ->add('content' , TextareaType::class, [
                'required' => true,
                'label' => "Contenu",
                'attr' => array(
                    'placeholder' => 'Ecrire votre article')
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
