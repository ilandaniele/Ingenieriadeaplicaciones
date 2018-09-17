package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class AvisoRequest extends StringRequest {
    private final static String AVISO_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/Aviso.php";
    private Map<String,String> params;
    public AvisoRequest(String tipoAviso, String titulo, String texto, String subtexto,Response.Listener<String> listener){
        super(Method.POST, AVISO_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("titulo",titulo);
        params.put("texto",texto);
        params.put("tipoaviso",tipoAviso);
        params.put("subtexto",subtexto);

    }


    public Map<String, String> getParams() {
        return params;
    }
}
