<?php

namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec;

class ComplexType extends \Hgs_Dom_Schema_ComplexType implements Codec
{
    public function encode($data, \DOMDocument $document)
    {
        $node = $document->createDocumentFragment();

        if ($this->all) {
            if ($this->all->elements) {
                $elements = $this->all->elements;
            }
            if ($this->all->choices) {
                $choices = $this->all->choices;
            }
        }

        if ($this->sequence) {
            if ($this->sequence->elements) {
                $elements = $this->sequence->elements;
            }
            if ($this->sequence->choices) {
                $choices = $this->sequence->choices;
            }
        }

        if (isset($elements)) {
            if (is_object($data)) {
                foreach ($elements as $name => $element) {
                    if ($element->minOccurs > 0) {
                        $value = $data->$name; // NOTICE!
                    } elseif (property_exists($data, $name)) {
                        $value = $data->$name;
                    } else {
                        continue; // skip
                    }
                    $node->appendChild($element->encode($value, $document));
                }
            }
            if (is_array($data)) {
                foreach ($elements as $name => $element) {
                    if ($element->maxOccurs === 'unbounded') {
                        foreach ($data as $name => $value) {
                            if (is_string($name)) {
                                continue; // skip
                            }
                            if ($child = $element->encode($value, $document)) {
                                $node->appendChild($child);
                            }
                        }
                    } elseif ($element->maxOccurs > 1) {
                        $occurs = 0;
                        foreach ($data as $name => $value) {
                            if (is_string($name)) {
                                continue; // skip
                            }
                            if ($occurs < $element->maxOccurs) {
                                $occurs++;
                            } else {
                                break;
                            }
                            if ($child = $element->encode($value, $document)) {
                                $node->appendChild($child);
                            }
                        }
                    } else {
                        if ($element->minOccurs > 0) {
                            $value = $data[$name]; // NOTICE!
                        } elseif (array_key_exists($name, $data)) {
                            $value = $data[$name];
                        } else {
                            continue; // skip
                        }
                        if ($child = $element->encode($value, $document)) {
                            $node->appendChild($child);
                        }
                    }
                }
            }
        }

        if (isset($choices)) {
            // @TODO where is this really coming from now?
            $classmap = $this->_getSchema()->getClassmap();
            // @todo implement multiple choices
            $choice = $choices[0];
            // @todo implement object choices
            if (is_array($data)) {
                // @todo TEST limited choice elements
                // @todo TEST single choice element
                if ($choice->maxOccurs === 'unbounded') {
                    foreach ($data as $name => $value) {
                        if (is_string($name)) {
                            continue; // skip
                        }
                        foreach ($choice->elements as $element) {
                            if (isset($classmap[$element->type])) {
                                if ($value instanceof $classmap[$element->type]) {
                                    if ($child = $element->encode($value, $document)) {
                                        $node->appendChild($child);
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else if ($choice->maxOccurs > 1) {
                    $occurs = 0;
                    foreach ($data as $name => $value) {
                        if (is_string($name)) {
                            continue; // skip
                        }
                        if ($occurs < $choice->maxOccurs) {
                            $occurs++;
                        } else {
                            break;
                        }
                        foreach ($choice->elements as $element) {
                            if (isset($classmap[$element->type])) {
                                if ($value instanceof $classmap[$element->type]) {
                                    if ($child = $element->encode($value, $document)) {
                                        $node->appendChild($child);
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($choice->minOccurs > 0) {
                        $value = $data[$name]; // NOTICE!
                    } elseif (array_key_exists($name, $data)) {
                        $value = $data[$name];
                    } else {
                        continue; // skip
                    }
                    foreach ($choice->elements as $element) {
                        if (isset($classmap[$element->type])) {
                            if ($value instanceof $classmap[$element->type]) {
                                if ($child = $element->encode($value, $document)) {
                                    $node->appendChild($child);
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($this->attributes) {
            if (is_object($data)) {
                foreach ($this->attributes as $name => $attribute) {
                    if ($attribute->use === 'required') {
                        $value = $data->$name; // NOTICE!
                    } elseif (isset($data->$name)) {
                        $value = $data->$name;
                    } else {
                        continue; // skip
                    }
                    $node->appendChild($attribute->encode($value, $document));
                }
            }
            if (is_array($data)) {
                foreach ($this->attributes as $name => $attribute) {
                    if ($attribute->use === 'required') {
                        $value = $data[$name]; // NOTICE!
                    } elseif (isset($data[$name])) {
                        $value = $data[$name];
                    } else {
                        continue; // skip
                    }
                    $node->appendChild($attribute->encode($value, $document));
                }
            }
        }

        return $node;
    }
}
