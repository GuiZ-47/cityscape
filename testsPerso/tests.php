<?php

class Categorytest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $metaTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $metaDescription = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    private ?self $parent = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $categories;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }
}

// // Pour utiliser faker
// use Faker\Factory;

// $faker = Factory::create('fr_FR');

$categories = [
    [
        'main_categories' => 'Page',
        'sub_category_array' => [
            'Property',
            'Property Sidebar',
            'Property Details',
            'Add New Listing',
            'About Us',
            'FAQ',
            'CheckOut',
            'Cart'
        ]
    ],

    [
        'main_categories' => 'Projects',
        'sub_category_array' => [
            'Project',
            'Project Details'
        ]
    ],

    [
        'main_categories' => 'Blog',
        'sub_category_array' => [
            'Blog Classic',
            'Blog Details'
        ]
    ],

    [
        'main_categories' => 'Contact Us',
        'sub_category_array' => []
    ],

];

foreach ($categories as $sub_array) {
    $sub_object_array = [];

    foreach ($sub_array['sub_category_array'] as $subcategory_name) {
        $subcategory = new Categorytest();
        $subcategory->setName($subcategory_name);
        $subcategory->setSlug('couccou');
        $subcategory->setMetaTitle('tata');
        $subcategory->setMetaDescription('oveoih');

        $sub_object_array[]= $subcategory;
        // echo ($subcategory);
        // echo '<br>';
    }
    // echo $sub_array['main_categories'];
    // echo '<br>';
    print_r($sub_object_array);
    // echo '<br>';

}
;


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        
        

        // foreach ($categories as $sub_array) {
        //     $sub_object_array = [];

        //     foreach ($sub_array['sub_category_array'] as $subcategory) {
        //         $sub_object = $subcategory;
        //         $sub_object_array[]= $sub_object;
        //         // echo ($subcategory);
        //         // echo '<br>';
        //     }
            
        //     echo $sub_array['main_categories'];
        //     echo '<br>';
        //     print_r($sub_object_array);
        //     echo '<br>';
        // }
        // ;

        ?>

    </body>
</html>

