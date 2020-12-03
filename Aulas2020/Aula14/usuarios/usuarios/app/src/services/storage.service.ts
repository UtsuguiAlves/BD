import { Injectable } from "@angular/core";
import { LOCALSTORAGEKEY } from "../config/storage_keys.config";
import { Usuario } from "../models/usuario.dto";

@Injectable()
export class StorageService {

    getUsuario(): Usuario {
        let str = localStorage.getItem(LOCALSTORAGEKEY.user);
        if (str != null) {
            return JSON.parse(str);
        } else {
            return null;
        }
    }

    setUsuario(obj: Usuario) {
        if (obj != null) {
            localStorage.setItem(LOCALSTORAGEKEY.user, JSON.stringify(obj));
            console.log(" chave = "+LOCALSTORAGEKEY.user+"valor = "+obj);
        } else {
            console.log("Entrei");
            localStorage.removeItem(LOCALSTORAGEKEY.user);
        }
    }
}