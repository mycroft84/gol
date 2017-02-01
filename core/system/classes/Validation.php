<?php defined('SYSPATH') OR die('No direct script access.');

class Validation extends Kohana_Validation {

    protected $_empty_rules = array('not_empty', 'not_empty_select', 'matches', 'is_checked','custom_not_empty');

    public function errors($file = NULL, $translate = TRUE)
    {
        if ($file === NULL)
        {
            // Return the error list
            return $this->_errors;
        }

        // Create a new message list
        $messages = array();

        foreach ($this->_errors as $field => $set)
        {
            /**
             * Módosítva a nyelvi mezők miatt, így csak el üzenetet kell felvinni
             */

            $oldField = $field;
            $field = current(explode('_lang_',$field));
            
            list($error, $params) = $set;

            // Get the label for this field
            $label = (isset($this->_labels[$field])) ? $this->_labels[$field] : "";

            if ($translate)
            {
                $label = str_replace(' ','_',$label);

                if (is_string($translate))
                {
                    // Translate the label using the specified language
                    $label = __($label, NULL, $translate);
                }
                else
                {
                    // Translate the label
                    $label = __($label);
                }
            }

            // Start the translation values list
            $values = array(
                ':field' => $label,
                ':value' => Arr::get($this, $field),
            );

            if (is_array($values[':value']))
            {
                // All values must be strings
                $values[':value'] = implode(', ', Arr::flatten($values[':value']));
            }

            if ($params)
            {
                foreach ($params as $key => $value)
                {
                    if (is_array($value))
                    {
                        // All values must be strings
                        $value = implode(', ', Arr::flatten($value));
                    }
                    elseif (is_object($value))
                    {
                        // Objects cannot be used in message files
                        continue;
                    }

                    // Check if a label for this parameter exists
                    if (isset($this->_labels[$value]))
                    {
                        // Use the label as the value, eg: related field name for "matches"
                        $value = $this->_labels[$value];

                        if ($translate)
                        {
                            if (is_string($translate))
                            {
                                // Translate the value using the specified language
                                $value = __($value, NULL, $translate);
                            }
                            else
                            {
                                // Translate the value
                                $value = __($value);
                            }
                        }
                    }

                    // Add each parameter as a numbered value, starting from 1
                    $values[':param'.($key + 1)] = $value;
                }
            }

            if ($message = Kohana::message($file, "{$field}.{$error}") AND is_string($message))
            {
                // Found a message for this field and error
            }
            elseif ($message = Kohana::message($file, "{$field}.default") AND is_string($message))
            {
                // Found a default message for this field
            }
            elseif ($message = Kohana::message($file, $error) AND is_string($message))
            {
                // Found a default message for this error
            }
            elseif ($message = Kohana::message('validation', $error) AND is_string($message))
            {
                // Found a default message for this error
            }
            else
            {
                // No message exists, display the path expected
                $message = "{$file}.{$field}.{$error}";
            }

            if ($translate)
            {
                if (is_string($translate))
                {
                    // Translate the message using specified language
                    $message = __($message, $values, $translate);
                }
                else
                {
                    // Translate the message using the default language
                    $message = __($message, $values);
                }
            }
            else
            {
                // Do not translate, just replace the values
                $message = strtr($message, $values);
            }

            // Set the message for this field
            $messages[$oldField] = $message;
        }

        return $messages;
    }

    public function getLang()
    {
        return array(
            'lang'=>(isset($this->_bound[':lang'])) ? $this->_bound[':lang'] : null,
            'tab'=>(isset($this->_bound[':tab'])) ? $this->_bound[':tab'] : null,
        );
    }
}
