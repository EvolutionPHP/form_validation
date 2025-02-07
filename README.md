# PHP Form Validation Library

Simple PHP Form Validator based in Code Igniter library.

## Installation

Use [Composer](http://getcomposer.org) to install Logger into your project:
```bash
composer require evolutionphp/form_validation
```

## Setting Validation Rules

Here is an example to set validation rules:

```php
$form_validation = new \EvolutionPHP\FormValidation\FormValidation();
$form_validation->set_rules('username','Username','required'); 
```

A complete code looks like this:

```php
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form_validation = new \EvolutionPHP\FormValidation\FormValidation();
    $form_validation->set_rules('username','Username','required');
    if($form_validation->run() == false){
        $error_msg = $form_validation->error_string();
    }
}
```

## Setting Rules Using an Array

Before moving on it should be noted that the rule setting method can be passed an array if you prefer to set all your rules in one action. If you use this approach, you must name your array keys as indicated:
```php
$rules = [
    [
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'required'
    ],
    [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|min_length[6]',
        'errors' => [
            'required' => 'Password is required.'        
         ]       
    ]
]
$form_validation->set_rules($rules); 
```
## Validating an Array (other than $_POST)

Sometimes you may want to validate an array that does not originate from $_POST data.
```php
$data = [
    'username' => 'smith',
    'password' => 'IAmGroot'
]
$form_validation->set_data($data); 
```


> [!IMPORTANT]
> For a full documentation visit the [CodeIgniter Form Validation](http://www.codeigniter.com/userguide3/libraries/form_validation.html) page.

## Extra Validation Rules
| Rule       | Parameter | Description                                                                                                                                                                                                            | Example            |
|------------| --------- |------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------|
| valid_date | Yes | Fails if field does not contain a valid date. Any string that strtotime() accepts is valid if you don’t specify an optional parameter that matches a date format. So it is usually necessary to specify the parameter. | valid_date[d/m/Y]  |
| valid_json | No | Fails if field does not contain a valid JSON string.                                                                                                                                                                   |                    |
| uploaded   | No | It works like 'required' but for $_FILES                                                                                                                                                                               |                    |
| is_image | No | Fails if the file cannot be determined to be an image based on the mime type. | |
| mime_in | Yes | Fails if the file’s mime type is not one listed in the parameters. | mime_in[image/png,image/jpeg] |
| ext_in | Yes | Fails if the file’s extension is not one listed in the parameters. | ext_in[png,jpg,gif] | 
| max_size   | Yes | Fails if the uploaded file is larger than the second parameter in kilobytes (kb).                                                                                                                                      | max_size[1024]     |
| max_dims   | Yes | Fails if the maximum width and height of an uploaded image exceed values.                                                                                                                                              | max_dims[468,60]   |
| min_dims   | Yes | Fails if the minimum width and height of an uploaded image not meet values.                                                                                                                                            | min_dims[468,60]   |
| exact_dims | Yes | Fails if the width and height of an uploaded image has different values.                                                                                                                                               | exact_dims[468,60] |

## Use translated error messages

By default, error messages are located in /src/Lang/data.php, you can use your own translation loading a new array data:
```php
$lang['form_validation_required'] = 'The {field} field is required.';
$lang['form_validation_is_image'] = 'The {field} field does not contains a valid image.';
$form_validation->set_language($data); 
```


## Authors

This library was primarily developed by [CodeIgniter 3](https://codeigniter.com/) and modified by [Andres M](https://twitter.com/EvolutionPHP).
