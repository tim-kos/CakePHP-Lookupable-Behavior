<?php
/**
 * CakePHP Behavior to quickly fetch a specific field value of a table depending on some conditions
 * and optionally creating the row if it's missing.
 *
 * @package default
 * @access public
 */
class LookupableBehavior extends ModelBehavior {
/**
 * A generic function that simply returns the value of a given $field for an record
 * that matches the given $conditions. If $create is set to true and no record matching
 * the conditions can be found, it will be created automatically.
 *
 * @param array $conditions
 * @param string $field
 * @param boolean $create
 * @return The field value
 * @access public
 */
  function lookup(&$model, $conditions, $field = 'id', $create = false) {
    if (!is_array($conditions)) {
      $conditions = array($model->displayField => $conditions);
    }

    if (!empty($field)) {
      $fieldValue = $model->field($field, $conditions);
    } else {
      $fieldValue = $model->find($conditions);
    }
    if ($fieldValue !== false) {
      return $fieldValue;
    }
    if (!$create) {
      return false;
    }
    $model->create($conditions);
    if (!$model->save()) {
      return false;
    }
    $conditions[$model->primaryKey] = $model->id;
    if (empty($field)) {
      return $model->read();
    }
    return $model->field($field, $conditions);
  }
}