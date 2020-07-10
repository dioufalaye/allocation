<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Etudiants;
use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('telephone')
            ->add('addresse' ,null,['label'=>false])
            ->add('date',null,[
            'widget'=>'single_text'])
            ->add('type' ,ChoiceType::class,[
                'placeholder'=>'Choisir le type ',
                'choices'=>[
                    'Boursier_loger'=>'Boursier_loger',
                    'Boursier_NonLoger'=>'Boursier_NonLoger',
                    'NonBoursier'=>'NonBoursier'
                ],
            ])
            ->add('relation' , EntityType::class,[
                'class' => Chambre::class,
                'choice_label' => 'numchambre',
                'label' => false
            ],
               
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
        ]);
    }
}
