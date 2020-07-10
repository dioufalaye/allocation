<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Chambre;
use App\Entity\Batiment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numchambre', null, [
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('type' , ChoiceType::class,[
                'placeholder'=>'Choisir le type de chambre',
                'choices'=>[
                    'Individuel'=>'Individuel',
                    'A deux'=>'A deux'
                ],
            ])
            ->add('batiment', EntityType::class,[
                'class'=> 'App\Entity\Batiment',
                'choice_label' => 'numbatiment'],
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
