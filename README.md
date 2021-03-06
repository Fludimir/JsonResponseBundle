BuJsonResponseBundle
=============
BuJsonResponseBundle helps you to use templates for json responses in
just same way as templates are used for html responses, allowing you to separate
business logic and data presentation when you need to return data in json format.

Based on @Template annotation from [SensioFrameworkExtraBundle](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html)
and requires it.

[![Build Status](https://secure.travis-ci.org/Fludimir/JsonResponseBundle.png?branch=master)](http://travis-ci.org/Fludimir/JsonResponseBundle)

Installation
-------------
Add bundle with composer: 

`composer require bu/json-response-bundle dev-master`

[Enable php templating engine](http://symfony.com/doc/current/cookbook/templating/PHP.html)
in your symfony config:
``` yaml
# app/config/config.yml
framework:
    # ...
    templating:
        engines: ['twig', 'php']
```

register bundle in AppKernel.php :
``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Bu\JsonResponseBundle\BuJsonResponseBundle(),
    );
}
```

Usage
-------------
Example controller:
``` php
<?php

namespace Application\MyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bu\JsonResponseBundle\Configuration\JsonResponseTemplate;


class ProductController extends Controller
{
    /**
     * @JsonResponseTemplate
     */
    public function listAction()
    {
        return array('products' => $this->get('my.product.service')->getAllProducts());
    }
}
```
Json template for listAction:
``` php
<?php
// Resources/view/Product/list.json.php

$data = array();
foreach ($products as $product) {
    $data[$product->getStatus()][] = array(
        'name'              => $product->getName(),
        'description'       => $product->getDescription(),
        'relationsCount'    => count($product->getRelations()),
        'isRequiresCheck'   => $product->isRequiresCheck(),
    );
}

$view['jsonResponse']->output($data);
```

Also there is simple JsonResponse class that can be used if you already have data prepared:
``` php
use Bu\JsonResponseBundle\HttpFoundation\JsonResponse;

    public function deleteAction(Product $product)
    {
        $this->get('my.product.service')->delete($product);

        return new JsonResponse(array('success' => true));
    }
```
As of Symfony 2.7 there is similar internal class Symfony\Component\HttpFoundation\JsonResponse https://symfony.com/doc/2.7/components/http_foundation.html#creating-a-json-response

License
-------
This bundle is under the MIT license.
