package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 16/11/2017.
 */

public class ExpositorRequest extends StringRequest {
// todo este código es para enviar estos datos al php que se encarga de mandarlo a la base de datos, servira para favoritos
    private static final String EXPOSITOR_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/Expositores.php";
    private Map<String,String> params;
    public ExpositorRequest(int idioma,Response.Listener<String> listener){
        super(Method.POST, EXPOSITOR_REQUEST_URL ,listener,null);
        params = new HashMap<>();
        params.put("idioma",idioma+"");
    }
    public Map<String, String> getParams() {
        return params;
    }
}
