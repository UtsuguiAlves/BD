import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Usuario } from "../models/usuario.dto";
import { APICONFIG } from "../config/api.config";

@Injectable()
export class UsuarioService {

    constructor(public httpClient: HttpClient) { }

    login(user: Usuario) {
        let url = APICONFIG.urlBase + "/webservice.php";
        let data = {
            "login": user.login,
            "senha": user.senha
        };
        let header = { "headers": { "Content-Type": "application/json" } };
        return this.httpClient.post(url, data, header);
    }

}