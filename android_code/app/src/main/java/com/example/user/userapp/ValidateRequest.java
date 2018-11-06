package com.example.user.userapp;


import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by jinhee park on 2018-10-08.
 */

public class ValidateRequest extends StringRequest {

    final static private String URL_id = "https://upcyclothes.duckdns.org/android//UserValidate.php";
    final static private String URL_nick = "https://upcyclothes.duckdns.org/android//nickNameValidate.php";
    private Map<String, String> parameters;

    public ValidateRequest(String userID,  Response.Listener<String> listener){
        super(Method.POST, URL_id, listener, null);
        parameters = new HashMap<>();
        parameters.put("userID", userID);
    }
    public ValidateRequest(String nickName, boolean option, Response.Listener<String> listener){
        super(Method.POST, URL_nick, listener, null);
        parameters = new HashMap<>();
        parameters.put("nickName", nickName);
    }

    @Override
    public Map<String, String> getParams(){
        return parameters;
    }
}