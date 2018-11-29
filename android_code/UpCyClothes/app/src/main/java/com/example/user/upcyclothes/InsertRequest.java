package com.example.user.upcyclothes;


import android.util.Log;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by jinhee on 2018-10-05.
 */

public class InsertRequest extends StringRequest {

    final static private String URL = "https://upcyclothes.duckdns.org/android/insert2Cart.php";
    private Map<String, String> parameters;

    public InsertRequest(String productID, String user_ID, String designer, String productName, String count, String price, String productURL, String quantity, Response.Listener<String> listener){
        super(Method.POST, URL, listener, null);
        parameters = new HashMap<>();
        parameters.put("productID", productID);
        parameters.put("user_ID", user_ID);
        parameters.put("designer", designer);
        parameters.put("productName", productName);
        parameters.put("count", count);
        parameters.put("price", price);
        parameters.put("productURL", productURL);
        parameters.put("quantity", quantity);
        Log.v("insert 정보",productID+user_ID+designer+productName+count+price+productURL+quantity);

    }

    @Override
    public Map<String, String> getParams(){
        return parameters;
    }
}