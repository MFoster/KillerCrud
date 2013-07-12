<?php

namespace Titan\KillerCrudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContractType extends AbstractType
{
    
    /**
     * Router instance used to generate the form's URL
     * 
     * @var mixed
     * @access protected
     */
    protected $router;
    
    
    public function __construct($router)
    {
        
        $this->router = $router;
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('target')
            ->add('address')
            ->add('reward')
            ->add('save', 'submit')
            ->setAction($this->router->getGenerator()->generate('contract_create'))
        ;
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Titan\KillerCrudBundle\Entity\Contract'
        ));
    }

    public function getName()
    {
        return 'contract_form';
    }
}
