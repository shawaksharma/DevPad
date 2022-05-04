<?php
/**
 * A class that contains code to handle any requests for  /newproject/
 *
 * @author Shawak Sharma <s.sharma@newcastle.ac.uk>
 * @copyright 2020 Shawak Sharma
 * @package Framework
 * @subpackage UserPages
 */
    namespace Pages;

    use \Support\Context as Context;
/**
 * Support /newproject/
 */
    class Newproject extends \Framework\Siteaction
    {
/**
 * Handle newproject operations
 *
 * @param Context   $context    The context object for the site
 *
 * @return string|array   A template name
 */
        public function handle(Context $context)
        {
            // Create project and collect all form data and set variables
            $fdt = $context->formdata('post');
        
            $project = \R::dispense('project');
            $project->name = $fdt->fetch('name');
            $project->description = $fdt->fetch('description', '');

            // Grab current time and format
            $project->time = (gmdate('d-m-y h:i:s', time()));

            // Fetch and check if project name field is empty
            $name = $fdt->fetch('name');

            if ($fdt->exists('name'))
            {
                if ($name !== '') 
                {   // If not empty, store and display message
                    \R::store($project);
                    $context->local()->message(\Framework\Local::MESSAGE, 'Added');
                }
                else
                {   // If empty display error message and not store
                    $context->local()->message(\Framework\Local::ERROR, 'Project name cannot be empty');
                }
    
            }

            return '@content/newproject.twig';
        }
    }
?>