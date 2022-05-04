<?php
 /**
  * Class for handling home pages
  *
  * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
  * @copyright 2012-2019 Newcastle University
  * @package Framework
  * @subpackage UserPages
  */
    namespace Pages;

    use \Support\Context as Context;
/**
 * A class that contains code to implement a home page
 * @psalm-suppress UnusedClass
 */
    class Home extends \Framework\SiteAction
    {
/**
 * Handle various contact operations /
 *
 * @param Context   $context    The context object for the site
 *
 * @return string   A template name
 * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
 */
        public function handle(Context $context)
        {
            // Find all projects and order them by name
            $projects = \R::findAll('project', 'ORDER BY name');

            // Send to twig
            $context->local()->addval('projects',$projects);
            
            return '@content/index.twig';
        }
    }
?>
