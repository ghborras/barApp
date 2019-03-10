<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;

class TapaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('descripcion', CKEditorType::class)
            ->add('ingredientes',  EntityType::class, array(
                // looks for choices from this entity
                'class' => Ingrediente::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
            
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('categoria', EntityType::class, array(
                // looks for choices from this entity
                'class' => Categoria::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))
            ->add('foto', FileType::class,  array(
                'attr' => array('onchange'=>'onChange(event)') ))
            ->add('top')
            ->add('salvar', SubmitType::class, array('label' => 'Crear Tapa'))
        ;
    }
}