<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Ad;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType 
{
	public function buildForm(FormBuilderInterface $builder, array $options) 
	{
		$builder
			->add('owner_name')
            ->add('owner_city')
            ->add('price')
            ->add('car_producer')
            ->add('car_model')
            ->add('car_year')
            ->add('Post', SubmitType::class, ['label' => 'Post Ad'])
        ;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults([
	        'data_class' => Ad::class,
	    ]);
	}
}