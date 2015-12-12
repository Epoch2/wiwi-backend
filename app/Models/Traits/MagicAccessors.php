<?php namespace App\Models\Traits;

/**
 * Created by Johan Vester
 * johan@assimilate.se
 *
 * Date: 08/12/15
 *
 * (c) 2015 Assimilate
 */

trait MagicAccessors
{
    /**
     * Map a call to get a property to its corresponding accessor if it exists.
     * Otherwise, get the property directly.
     *
     * Ignore any properties that begin with an underscore so not all of our
     * protected properties are exposed.
     *
     * @param  string $name
     * @return mixed
     * @throws \LogicException If no accessor/property exists by that name
     */
    public function __get($name)
    {
        if ($name[0] != '_') {
            $accessor = 'get'. ucfirst($name);
            if (method_exists($this, $accessor)) {
                return $this->$accessor();
            }

            if (property_exists($this, $name)) {
                return $this->$name;
            }
        }

        throw new \LogicException(sprintf(
            'No property named `%s` exists',
            $name
        ));
    }

    /**
     * Map a call to set a property to its corresponding mutator if it exists.
     * Otherwise, set the property directly.
     *
     * Ignore any properties that begin with an underscore so not all of our
     * protected properties are exposed.
     *
     * @param  string $name
     * @param  mixed  $value
     * @return void
     * @throws \LogicException If no mutator/property exists by that name
     */
    public function __set($name, $value)
    {
        if ($name[0] != '_') {
            $mutator = 'set'. ucfirst($name);
            if (method_exists($this, $mutator)) {
                $this->$mutator($value);
                return;
            }

            if (property_exists($this, $name)) {
                $this->$name = $value;
                return;
            }
        }

        throw new \LogicException(sprintf(
            'No property named `%s` exists',
            $name
        ));
    }

    /**
     * Map a call to a non-existent mutator or accessor directly to its
     * corresponding property
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     * @throws \BadMethodCallException If no mutator/accessor can be found
     */
    public function __call($name, $arguments)
    {
        if (strlen($name) > 3) {
            if (strpos($name, 'set') === 0) {
                $property = lcfirst(substr($name, 3));

                $this->$property = array_shift($arguments);
                return $this;
            }

            if (0 === strpos($name, 'get')) {
                $property = lcfirst(substr($name, 3));

                return $this->$property;
            }
        }

        throw new \BadMethodCallException(sprintf(
            'No method named `%s` exists',
            $name
        ));
    }
}