<?php

namespace AppBundle\Form;

use AppBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class userType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = new Translator('fr_FR');
        $builder
            ->add('username', TextType::class, array(
                'label' => $translator->trans('register.user')
            ))
            ->add('email', EmailType::class, array(
                'label' => $translator->trans('register.mail')
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'first_options' => array('label' => $translator->trans('register.pass')),
                'second_options' => array('label' => $translator->trans('register.pass2'))))
            ->add('cancel', SubmitType::class, array(
                'label' => $translator->trans('register.cancel'),
                'attr' => array(
                    'class' => 'btn btn-danger pull-right',
                    'style' => 'margin-left: 10px;',
                    'formnovalidate' => 'formnovalidate',
                    'name' => $translator->trans('register.cancel')
                )
            ))
            ->add('submit', SubmitType::class, [
                'label' => $translator->trans('register.submit'),
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}