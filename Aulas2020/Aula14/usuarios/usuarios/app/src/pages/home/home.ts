import { Component } from '@angular/core';
import { NavController, IonicPage, MenuController, AlertController } from 'ionic-angular';
import { Usuario } from '../../models/usuario.dto';
import { StorageService } from '../../services/storage.service';
import { UsuarioService } from '../../services/usuario.service';

@IonicPage()

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  user: Usuario = {
    "login": "",
    "senha": "",
    "tipo":""
  };

  constructor(public navCtrl: NavController,
    public menu: MenuController,
    public userService: UsuarioService,
    public alertController: AlertController,
    public storageService: StorageService) { }

  ionViewWillEnter() {
    this.menu.swipeEnable(false);
  }

  ionViewDidLeave() {
    this.menu.swipeEnable(true);
  }

  login() {
    if(this.user.login !== "" && this.user.senha !== ""){
      this.userService.login(this.user).subscribe(
        (response:any)=>{
          if(response.hasOwnProperty("erro")){
            this.presentAlert(response.erro);
          }else{
            this.user = response;
            this.storageService.setUsuario(this.user);
            if(this.user.tipo === "comum"){
              this.presentAlert("Bem vindo Usuário");
              this.navCtrl.setRoot("ComumPage");
            }else{
              this.presentAlert("Bem vindo Administrador");
              this.navCtrl.setRoot("AdminPage");
            }
          }
        },error=>{
          this.presentAlert("Erro ao enviar e receber dados do WebService");
        }
      );
    } else {
      this.presentAlert("Digite o login e a senha");
    }
  }

  presentAlert(msg : String){
    let alert = this.alertController.create({
      title: "Aviso",
      subTitle: msg,
      buttons: ["ok"]
    });
    alert.present();
  }

}
