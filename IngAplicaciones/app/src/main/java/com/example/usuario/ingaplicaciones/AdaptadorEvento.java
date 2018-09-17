package com.example.usuario.ingaplicaciones;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Usuario on 19/11/2017.
 */

public class AdaptadorEvento extends BaseAdapter {

    private Context contexto;
    private ArrayList<EntidadEvento> listaEventos;

    public AdaptadorEvento(Context contexto, ArrayList<EntidadEvento> listaEventos){
        this.contexto=contexto;
        this.listaEventos = listaEventos;
    }
    @Override
    public int getCount() {
        return listaEventos.size();
    }

    @Override
    public Object getItem(int i) {
        return listaEventos.get(i);
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        EntidadEvento item = (EntidadEvento) getItem(i);
        view = LayoutInflater.from(contexto).inflate(R.layout.itemevento,null);
        TextView tv_nombre = (TextView) view.findViewById(R.id.textV_nombre);
        TextView tv_lugar = (TextView) view.findViewById(R.id.textV_lugar);
        TextView tv_horario = (TextView) view.findViewById(R.id.textV_horario);
        TextView tv_expositor = (TextView) view.findViewById(R.id.textV_expositor);
        tv_nombre.setText(listaEventos.get(i).getNombre());
        tv_lugar.setText(listaEventos.get(i).getLugar());
        tv_horario.setText(listaEventos.get(i).getHorario());
        String aux = listaEventos.get(i).getNombre_Expositor() +" "+listaEventos.get(i).getApellido_Expositor();
        tv_expositor.setText(aux);
        return view;
    }
}
