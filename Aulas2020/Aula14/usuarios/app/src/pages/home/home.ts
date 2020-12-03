import { Component } from '@angular/core';
import { NavController, IonicPage, MenuController } from 'ionic-angular';
import { Usuario } from '../../models/usuario.dto';

@IonicPage()

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  user : Usuario = {
    idPessoa: "",
    login : "",
    senha : "",
    tipo : ""
  }  

  constructor(public navCtrl: NavController, public menu: MenuController) {

  }

  ionViewWillEnter() {
    this.menu.swipeEnable(false);
  }
  
  ionViewDidLeave() {
    this.menu.swipeEnable(true);
  }

  login(){
    console.log(this.user);
    //this.navCtrl.setRoot('ComumPage');
  }
}
