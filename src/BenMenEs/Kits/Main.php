<?php

namespace BenMenEs\Kits;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\item\Item;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;

class Main extends PluginBase{

    public function onEnable() : void{
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
        $this->start = new Config($this->getDataFolder() . 'start.json', Config::JSON);
        $this->vip = new Config($this->getDataFolder() . 'vip.json', Config::JSON);
        $this->premium = new Config($this->getDataFolder() . 'premium.json', Config::JSON);
        $this->pro = new Config($this->getDataFolder() . 'pro.json', Config::JSON);
    }

    public function kitStart(Player $player) : void{
        if($this->start->exists(strtolower($player->getName()))){
            if(!$this->timePassed($player->getName())){
                $player->sendMessage("§l[§c!§r§l]§r Этот набор можно взять только раз в 24 часа");
                return;
            }
        }
        $this->start->set(strtolower($player->getName()), time() + 60 * 60 * 24);
        $this->start->save();
        foreach($this->config['start']['items'] as $item){
            $e = explode("-", $item);
            $id = $e[0];
            $meta = $e[1];
            $count = $e[2];
            $player->getInventory()->addItem(Item::get($id, $meta, $count));
        }
        $h = Item::get(298);
        $c = Item::get(299);
        $l = Item::get(300);
        $b = Item::get(301);
        $h->setCustomName("§lНачальный шлем игрока ". $player->getName());
        $c->setCustomName("§lНачальный нагрудник игрока ". $player->getName());
        $l->setCustomName("§lНачальные штаны игрока ". $player->getName());
        $b->setCustomName("§lНачальные ботинки игрока ". $player->getName());
        $player->getArmorInventory()->setHelmet($h);
        $player->getArmorInventory()->setChestplate($c);
        $player->getArmorInventory()->setLeggings($l);
        $player->getArmorInventory()->setBoots($b);
        $player->sendMessage("§7(§bНабор§7)§r Вы успешно получили стартовый набор!");
    }

    public function kitVip(Player $player) : void{
        if($this->vip->exists(strtolower($player->getName()))){
            if(!$this->timePassed($player->getName(), 'vip')){
                $player->sendMessage("§l[§c!§r§l]§r Этот набор можно взять только раз в 24 часа");
                return;
            }
        }
        $this->vip->set(strtolower($player->getName()), time() + 60 * 60 * 24);
        $this->vip->save();
        foreach($this->config['vip']['items'] as $item){
            $explode = explode("-", $item);
            $id = $explode[0];
            $meta = $explode[1];
            $count = $explode[2];
            $player->getInventory()->addItem(Item::get($id, $meta, $count));
        }
        $h = Item::get(306);
        $c = Item::get(307);
        $l = Item::get(308);
        $b = Item::get(309);
        $h->setCustomName("§lВип шлем игрока §c". $player->getName());
        $c->setCustomName("§lВип нагрудник игрока §c". $player->getName());
        $l->setCustomName("§lВип штаны игрока §c". $player->getName());
        $b->setCustomName("§lВип ботинки игрока §c". $player->getName());
        $player->getArmorInventory()->setHelmet($h);
        $player->getArmorInventory()->setChestplate($c);
        $player->getArmorInventory()->setLeggings($l);
        $player->getArmorInventory()->setBoots($b);
        $player->sendMessage("§7(§bНабор§7)§r Вы успешно получили вип набор!");
    }

    public function kitPremium(Player $player) : void{
        if($this->premium->exists(strtolower($player->getName()))){
            if(!$this->timePassed($player->getName(), 'premium')){
                $player->sendMessage("§l[§c!§r§l]§r Этот набор можно взять только раз в 24 часа");
                return;
            }
        }
        $this->premium->set(strtolower($player->getName()), time() + 60 * 60 * 24);
        $this->premium->save();
        foreach($this->config['premium']['items'] as $item){
            $explode = explode("-", $item);
            $id = $explode[0];
            $meta = $explode[1];
            $count = $explode[2];
            $player->getInventory()->addItem(Item::get($id, $meta, $count));
        }
        $h = Item::get(310);
        $c = Item::get(311);
        $l = Item::get(312);
        $b = Item::get(313);
        $h->setCustomName("§lПремиум шлем игрока §e". $player->getName());
        $c->setCustomName("§lПремиум нагрудник игрока §e". $player->getName());
        $l->setCustomName("§lПремиум штаны игрока §e". $player->getName());
        $b->setCustomName("§lПремиум ботинки игрока §e". $player->getName());
        $player->getArmorInventory()->setHelmet($h);
        $player->getArmorInventory()->setChestplate($c);
        $player->getArmorInventory()->setLeggings($l);
        $player->getArmorInventory()->setBoots($b);
        $player->sendMessage("§7(§bНабор§7)§r Вы успешно получили премиум набор!");
    }

    public function kitPRO(Player $player) : void{
        if($this->pro->exists(strtolower($player->getName()))){
            if(!$this->timePassed($player->getName(), 'pro')){
                $player->sendMessage("§l[§c!§r§l]§r Этот набор можно взять только раз в 24 часа");
                return;
            }
        }
        $this->pro->set(strtolower($player->getName()), time() + 60 * 60 * 24);
        $this->pro->save();
        $items = [
            Item::get(17, 0, 64),
            Item::get(17, 0, 64),
            Item::get(276),
            Item::get(264, 0, 32),
            Item::get(278),
            Item::get(279),
            Item::get(20, 0, 64),
            Item::get(35, 0, 64),
            Item::get(50, 0, 64),
            Item::get(322, 0, 8),
            Item::get(355),
            Item::get(219),
            Item::get(261),
            Item::get(262, 0, 32),
            Item::get(265, 0, 64),
            Item::get(61),
            Item::get(58),
            Item::get(364, 0, 64),
            Item::get(368, 0, 16),
            Item::get(47, 0, 32)
        ];
        foreach($items as $item){
            $player->getInventory()->addItem($item);
        }
        $h = Item::get(310);
        $c = Item::get(311);
        $l = Item::get(312);
        $b = Item::get(313);
        $h->setCustomName("§lСупер шлем игрока §b". $player->getName());
        $c->setCustomName("§lСупер нагрудник игрока §b". $player->getName());
        $l->setCustomName("§lСупер штаны игрока §b". $player->getName());
        $b->setCustomName("§lСупер ботинки игрока §b". $player->getName());
        $h->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
        $c->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
        $l->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
        $b->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(17), 4));
        $c->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(5), 2));
        $h->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 4));
        $c->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 4));
        $l->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 4));
        $b->addEnchantment(new EnchantmentInstance(Enchantment::getEnchantment(0), 4));
        $player->getArmorInventory()->setHelmet($h);
        $player->getArmorInventory()->setChestplate($c);
        $player->getArmorInventory()->setLeggings($l);
        $player->getArmorInventory()->setBoots($b);
        $player->sendMessage("§7(§bНабор§7)§r Вы успешно получили ПРО набор!");
    }

    private function timePassed($player, $kit = 'start') : bool{
        switch($kit){
            case 'start':
                return $this->start->getAll()[strtolower($player)] <= time();
            break;
            case 'vip':
                return $this->vip->getAll()[strtolower($player)] <= time();
            break;
            case 'premium':
                return $this->premium->getAll()[strtolower($player)] <= time();
            break;
            case 'pro':
                return $this->pro->getAll()[strtolower($player)] <= time();
            break;
        }
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        switch(strtolower($command->getName())){
            case "start":
                $this->kitStart($sender);
                return false;
            break;
            case "vip":
                $this->kitVip($sender);
                return false;
            break;
            case "premium":
                $this->kitPremium($sender);
                return false;
            break;
            case "pro":
                $this->kitPRO($sender);
                return false;
            break;
        }
        return true;
    }
}
