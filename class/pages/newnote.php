<?php
/**
 * A class that contains code to handle any requests for  /newnote/
 *
 * @author Shawak Sharma <s.sharma@newcastle.ac.uk>
 * @copyright 2020 Shawak Sharma
 * @package Framework
 * @subpackage UserPages
 */
    namespace Pages;

    use \Support\Context as Context;
/**
 * Support /newnote/
 */
    class Newnote extends \Framework\Siteaction
    {
/**
 * Handle newnote operations
 *
 * @param Context   $context    The context object for the site
 *
 * @return string|array   A template name
 */
        public function handle(Context $context)
        {
            //  Get URL
            $rest = $context->rest();

            // Send Project ID to twig for breadcrumb link
            $context->local()->addval('index', $rest[0]);

            // Load
            $note = \R::load('note',$rest[0]);

            // Create note and collect all form data and set variables
            $fdt = $context->formdata('post');

            $note = \R::dispense('note');
            $note->title = $fdt->fetch('title');
            $note->content = $fdt->fetch('content', '');
            $note->projectID = $rest[0];

            // Grab current time and format 
            $note->time = (gmdate('d-m-y h:i:s', time()));

            /*$file = $fdt->fetch('file');
            $upl = \R::dispense('upload');
            $sfile = $upl->savefile($fdt, $file, $acc, $user, $ix);*/

            // Fetch and check if note title field is empty
            $title = $fdt->fetch('title');

            if ($fdt->exists('title'))
            {
                if ($title !== '') 
                {   // If not empty, store and display message
                    \R::store($note);
                    $context->local()->message(\Framework\Local::MESSAGE, 'Added');
                }
                else
                {   // If empty display error message and not store
                    $context->local()->message(\Framework\Local::ERROR, 'Note title cannot be empty');
                }
    
            }
            return '@content/newnote.twig';
        }
    }
?>S