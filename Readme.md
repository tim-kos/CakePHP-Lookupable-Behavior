# Lookupable Behavior

CakePHP Behavior to quickly fetch a specific field value of a table depending on some conditions and optionally creating the row if it's missing.
This is useful to have critical records in your database automatically created if they are missing.

## Installation

Move the file to your behaviors folder.

## Tutorial

In your model's `$actsAs` variable add the following:

    'Lookupable'

Then in your model you can simply do:

    $this->lookup(array('field' => 'value'), 'field_name_to_fetch');

.. to fetch the <field_name_to_fetch> for the record where field = 'value' is true.


Here are some real world examples:

    // lookup the rating for a game
    $id = 'some id';
    $this->Game->lookup(compact('id'), 'rating');


    // automatically check against the model's displayField using easy syntax
    // the field parameter defaults to 'id'
    $authType = $this->AuthType->lookup('Lost Password');


    // create a record if it does not exist
    // the data it will be created with equals the conditions array
    $authType = $this->User->lookup(array('type' => 'guest'), 'id', true);

#Changelog

0.1.0 is the current version