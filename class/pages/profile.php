<?php
/**
 * A class that contains code to handle any requests for  /profile/
 *
 * @author Shawak Sharma <s.sharma@newcastle.ac.uk>
 * @copyright 2020 Shawak Sharma
 * @package Framework
 * @subpackage UserPages
 */
    namespace Pages;

    use \Support\Context as Context;
/**
 * Support /profile/
 */
    class Profile extends \Framework\Siteaction
    {
/**
 * Handle profile operations
 *
 * @param Context   $context    The context object for the site
 *
 * @return string|array   A template name
 */
        public function handle(Context $context)
        {
            $fdt = $context->formdata('post');
            if ($fdt->exists('email'))
            {
                $change = FALSE;
                $user = $context->user();
                try
                {
                    $email = $fdt->mustfetch('email', FILTER_VALIDATE_EMAIL);
                    if ($email !== $user->email)
                    {   // If not same email as current user's email
                        $user->email = $email;
                        $change = TRUE;
                    }
                }
                catch (\Framework\Exception\BadValue $e)
                {
                    $context->local()->message(\Framework\Local::ERROR, 'Invalid email address');

                }
                $pw = $fdt->mustfetch('pw');
                if ($pw !== '')
                {   // If password field if not empty
                    if ($pw !== $fdt->mustfetch('rpw'))
                    {   // If the passwords don't match
                        $context->local()->message(\Framework\Local::ERROR, 'Passwords do not match');
                    }
                    elseif (!\Model\User::pwValid($pw))
                    {   // If password doesn't meet the password's rules
                        $context->local()->message(\Framework\Local::ERROR, 'Password is too weak');
                    }
                    else
                    {   // If no problems then store
                        $user->setpw($pw);
                        $change = TRUE;
                    }
                }
                if ($change)
                {   // If change has occured store
                    \R::store($user);
                    
                }
            }
            return '@content/profile.twig';
        }
    }
?>