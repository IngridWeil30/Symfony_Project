<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BiddingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bid');

/* POUR FAIRE UN SLIDER
        $builder->add('bid', RangeType::class, array(
            'attr' => array(
                'min' => $options['bestPrice'] + $options['minimumBid'],
                'max' => $options['immediatePrice']
                + ajouter oninput (voir site : https://codepen.io/anon/pen/zxLpEB)
            )*/
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bidding'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_bidding';
    }


}
