<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tech;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductType extends AbstractType
{

    public function __construct(private UrlGeneratorInterface $url)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $editedObject = $builder->getData();

        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('project_logo', FileType::class)
            ->add('project_image', FileType::class)

            ->add('tech', SearchableEntityType::class,[
                'class' => Tech::class,
                'search' => $this->url->generate('techs'),
                'label_property' => 'name',
                'value_property' => 'id',
                'name' => 'product[tech]'
            ])
            ->add('collaborators', SearchableEntityType::class,[
                'class' => User::class,
                'search' => $this->url->generate('users'),
                'label_property' => 'email',
                'value_property' => 'id',
                'name' => 'product[collaborators]'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Project'
            ])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
