<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hiject\Core\Plugin;

/**
 * Plugin Base class
 */
abstract class Base extends \Hiject\Core\Base
{
    /**
     * Method called for each request
     *
     * @abstract
     * @access public
     */
    abstract public function initialize();

    /**
     * Override default CSP rules
     *
     * @access public
     * @param  array  $rules
     */
    public function setContentSecurityPolicy(array $rules)
    {
        $this->container['cspRules'] = $rules;
    }

    /**
     * Returns all classes that needs to be stored in the DI container
     *
     * @access public
     * @return array
     */
    public function getClasses()
    {
        return array();
    }

    /**
     * Returns all helper classes that needs to be stored in the DI container
     *
     * @access public
     * @return array
     */
    public function getHelpers()
    {
        return array();
    }

    /**
     * Listen on internal events
     *
     * @access public
     * @param  string   $event
     * @param  callable $callback
     */
    public function on($event, $callback)
    {
        $container = $this->container;

        $this->dispatcher->addListener($event, function () use ($container, $callback) {
            call_user_func($callback, $container);
        });
    }

    /**
     * Get plugin name
     *
     * This method should be overridden by your Plugin class
     *
     * @access public
     * @return string
     */
    public function getPluginName()
    {
        return ucfirst(substr(get_called_class(), 16, -7));
    }

    /**
     * Get plugin description
     *
     * This method should be overridden by your Plugin class
     *
     * @access public
     * @return string
     */
    public function getPluginDescription()
    {
        return '';
    }

    /**
     * Get plugin author
     *
     * This method should be overridden by your Plugin class
     *
     * @access public
     * @return string
     */
    public function getPluginAuthor()
    {
        return '?';
    }

    /**
     * Get plugin version
     *
     * This method should be overridden by your Plugin class
     *
     * @access public
     * @return string
     */
    public function getPluginVersion()
    {
        return '?';
    }

    /**
     * Get plugin homepage
     *
     * This method should be overridden by your Plugin class
     *
     * @access public
     * @return string
     */
    public function getPluginHomepage()
    {
        return '';
    }
}