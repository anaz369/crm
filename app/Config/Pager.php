<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Templates
     * --------------------------------------------------------------------------
     *
     * Pagination links are rendered out using views to configure their
     * appearance. This array contains aliases and the view names to
     * use when rendering the links.
     *
     * Within each view, the Pager object will be available as $pager,
     * and the desired group as $pagerGroup;
     *
     * @var array<string, string>
     */
    public array $templates = [
        'default_full' => 'CodeIgniter\Pager\PagerRenderer',
        'default_simple' => 'CodeIgniter\Pager\SimplePagerRenderer',
        'default_head' => 'CodeIgniter\Pager\SimplePagerRenderer',
        'template' => 'default_full',
        'pageCount' => 5,
        // Number of page links to show
    ];

    /**
     * --------------------------------------------------------------------------
     * Items Per Page
     * --------------------------------------------------------------------------
     *
     * The default number of results shown in a single page.
     */
    //public int $perPage = 20;
    public $defaultGroup = 'default';

    public $default = [
        'perPage' => 10,
        'uriSegment' => 3,
        'useGlobalQueryFilters' => true,
        'queryVar' => 'page',
        'pageQueryVar' => 'page',
        'total' => null,
    ];

}