import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-rutinas',
  templateUrl: './rutinas.page.html',
  styleUrls: ['./rutinas.page.scss'],
})
export class RutinasPage implements OnInit {

  idMascota: string;
  nombre;
  foto;
  rutinas = []; 

  constructor(
    private activatedRoute: ActivatedRoute,
    private http: HttpClient
  ) { }

  ngOnInit() {

    this.idMascota = this.activatedRoute.snapshot.paramMap.get('id')
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.nombre = res[0].nombre)
    this.http.get('http://localhost/cuida-tu-mascota/api/mascota/read_one.php?id=' + this.idMascota)
      .subscribe(res => this.foto = res[0].foto_mascota)

    this.http.get<any>( 'http://localhost/cuida-tu-mascota/api/rutinas/read.php?id_mascota='+this.idMascota)
    .subscribe(res=> {
      this.rutinas = res[0].records;
      console.log(this.rutinas);
    })

  }

}