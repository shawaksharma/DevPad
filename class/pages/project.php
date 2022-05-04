<?php
/**
 * A class that contains code to handle any requests for  /project/
 *
 * @author Shawak Sharma <s.sharma@newcastle.ac.uk>
 * @copyright 2020 Shawak Sharma
 * @package Framework
 * @subpackage UserPages
 */
    namespace Pages;

    use \Support\Context as Context;
/**
 * Support /project/
 */
    class Project extends \Framework\Siteaction
    {
/**
 * Handle project operations
 *
 * @param Context   $context    The context object for the site
 *
 * @return string|array   A template name
 */
        public function handle(Context $context)
        {
            // Grab URL
            $rest = $context->rest();

            // Load
            $project = \R::load('project',$rest[0]);

            // Send to twig
            $context->local()->addval('project', $project);
            
            // Find all notes belonging to this project
            $notes = \R::findAll('note', 'project_id = ?', [$rest[0]]);

            // Send to twig
            $context->local()->addval('notes', $notes);

            // Check if URL came with an extra field
            if(array_key_exists(1, $rest))
            {
                // If this field is delete, then delete
                if ($rest[1] === 'delete')
                {   // Delete both project and its notes and return to home
                    \R::trash($project);
                    \R::trashAll($notes);
                    $context->divert('/');
                }
            }



            return '@content/project.twig';
        }
    }
?>