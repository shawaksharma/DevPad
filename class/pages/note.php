<?php
/**
 * A class that contains code to handle any requests for  /note/
 *
 * @author Shawak Sharma <s.sharma@newcastle.ac.uk>
 * @copyright 2020 Shawak Sharma
 * @package Framework
 * @subpackage UserPages
 */
    namespace Pages;

    use \Support\Context as Context;
/**
 * Support /note/
 */
    class Note extends \Framework\Siteaction
    {
/**
 * Handle note operations
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
            $note = \R::load('note',$rest[0]);

            // Send to twig
            $context->local()->addval('note', $note);

            // Check if incoming URL has an extra field
            if(array_key_exists(1, $rest))
            {
                if ($rest[1] === 'delete')
                {   // If this field is delete then delete and return to project
                    \R::trash($note);
                    $context->divert('/project/'.$note->projectID);
                }
            }

            return '@content/note.twig';
        }
    }
?>