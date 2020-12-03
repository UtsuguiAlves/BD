import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Pessoa } from "../../models/pessoa.dto";
import { PessoaService } from '../../services/pessoa.service';
import { StorageService } from '../../services/storage.service';

/**
 * Generated class for the AdminPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-admin',
  templateUrl: 'admin.html',
})
export class AdminPage {

  pessoas: Pessoa[];

  constructor(public navCtrl: NavController,
    public navParams: NavParams,
    public pessoaService: PessoaService,
    public storageService: StorageService) {
  }

  ionViewDidLoad() {
    console.log(this.storageService.getUsuario());
    let id = "0";
    this.pessoaService.get(id).subscribe(
      (response:Pessoa[])=>{
        this.pessoas = response;
      },
      error => {
        console.log(error);
      }
    );
  }

}
