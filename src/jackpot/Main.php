<?php

//Plugin Make By PmmdSt Don't Change The Author, This Is Just The 0.1 Version Of This Plugin :)

namespace jackpot;

use pocketmine\Server;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;

use onebone\pointapi\PointAPI;

use onebone\coinapi\CoinAPI;

use jojoe77777\FormAPI\CustomForm;

class Main extends PluginBase implements Listener {

  

  public function onEnable(){

    $this->getLogger()->info("JackPot Enable");

    $this->money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");

    $this->point = $this->getServer()->getPluginManager()->getPlugin("PointAPI");

    $this->coin = $this->getServer()->getPluginManager()->getPlugin("CoinAPI");

  }

  

  public function onDisable(){

    $this->getLogger()->info("JackPot Disable");

  }

  

  public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args): bool{

    switch($cmd->getName()){

      case "jackpot":

        if ($sender instanceof Player){

          $this->JackPotUi($sender);

        }else{

          $sender->sendMessage("Pls Use In Game"); //If $sender is not player this will run

        }

    }

    return true;

  }

  

  public function JackPotUi($player){

    $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");

    $form = $api->createCustomForm(function(Player $player, array $data = null){

      

      if($data === null){

        return true;

      }
      if($data[0] == null){
        $player->sendMessage("Thank for support");
        return true;
      }

      $money = EconomyAPI::getInstance()->myMoney($player);

      if($money >= $data[0]){ 

        switch((mt_rand(0, 8))){

          case 0: // ∆ O U

            $this->money->reduceMoney($player, $data[0]);

            $player->sendMessage("§l§c ∆ | O | U, Thật Không May Bạn Thua Rồi");

            break;

            

           case 1: // O O O

             $this->money->addMoney($player, $data[0] * 2);

             $player->sendMessage("§l§a O | O | O, Chúc Mừng Bạn Đã Thắng Và Được Thưởng Gấp Đôi");

             break;

             

             case 2: // U O ∆

             $this->money->reduceMoney($player, $data[0]);

               $player->sendMessage("§l§c U | O | ∆, Thật Không May Bạn Thua Rồi");

               break;

               

               case 3: //  ∆ ∆ ∆

                 $this->money->addMoney($player, $data[0] * 2);

             $player->sendMessage("§l§a ∆ | ∆ | ∆, Chúc Mừng Bạn Đã Thắng Và Được Thưởng Gấp Đôi");

                 break;

                 

          case 4: // O ∆ U

          $this->money->reduceMoney($player, $data[0]);

            $player->sendMessage("§l§c O | ∆ | U, Thật Không May Bạn Thua Rồi");

            break;

            

           case 5: // U ∆ O

           $this->money->reduceMoney($player, $data[0]);

             $player->sendMessage("§l§c U | ∆ | O, Thật Không May Bạn Thua Rồi");

             break;

             

             case 6: // O U ∆

             $this->money->reduceMoney($player, $data[0]);

               $player->sendMessage("§l§c O | U | ∆, Thật Không May Bạn Thua Rồi");

               break;

               

               case 7: // ∆ U O

               $this->money->reduceMoney($player, $data[0]);

                 $player->sendMessage("§l§c ∆ | U | O, Thật Không May Bạn Thua Rồi");

                 break; 

                 

                 case 8: // U U U

                   $this->money->addMoney($player, $data[0] * 2);

             $player->sendMessage("§l§c U | U | U, Chúc Mừng Bạn Đã Thắng Và Được Thưởng Gấp Đôi");

                   break;

        }

      }

    });

    $form->setTitle("§l§c• Jackpot •");

    $form->addInput("§l§a• Nhập Số Tiền Muốn Đặt Cược\n§l§a• Nếu Thắng Sẽ Được Nhận Gấp Đôi", "0");

    $form->sendToPlayer($player);

    return $form;

  }

  

} 
