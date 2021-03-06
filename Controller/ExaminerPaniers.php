<?php
/*************************************************************************************/
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE      */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

/**
 * Created by Franck Allimant, CQFDev <franck@cqfdev.fr>
 * Date: 14/05/2017 11:31
 */
namespace PaniersAbandonnes\Controller;

use PaniersAbandonnes\Events\PaniersAbandonnesEvent;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\Event\DefaultActionEvent;
use Thelia\Core\HttpFoundation\Response;
use Thelia\Log\Tlog;

class ExaminerPaniers extends BaseFrontController
{
    public function examiner()
    {
        try {
            $this->getDispatcher()->dispatch(
                PaniersAbandonnesEvent::EXAMINER_PANIERS_EVENT,
                new DefaultActionEvent()
            );

        } catch (\Exception $ex) {
            Tlog::getInstance()->error("Echec de l'examen des paniers abandonnés :" . $ex->getMessage());
            Tlog::getInstance()->error($ex);

            throw $ex;
        }

        return new Response("Examen des paniers abandonnés terminé.");
    }
}
