package com.example.user.upcyclothes;


import android.util.Log;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by jinhee on 2018-10-05.
 */

public class QuestionRequest extends StringRequest {

    final static private String URL = "https://upcyclothes.duckdns.org/android/QuestionRegister.php";
    private Map<String, String> parameters;

    public QuestionRequest(String productID,String messageDate,String messageTitle,   String messageContent,String answer, String userID, String designerID, String readmark, Response.Listener<String> listener){
        super(Method.POST, URL, listener, null);
        parameters = new HashMap<>();
        parameters.put("productID", productID);
        parameters.put("messageDate", messageDate);
        parameters.put("messageTitle", messageTitle);
        parameters.put("messageContent", messageContent);
        parameters.put("answer", answer);
        parameters.put("userID", userID);
        parameters.put("designerID", designerID);
        parameters.put("readmark", readmark);
        Log.v("문의정보",productID+messageDate+messageTitle+messageContent+answer+userID+designerID+readmark);

    }

    @Override
    public Map<String, String> getParams(){
        return parameters;
    }
}