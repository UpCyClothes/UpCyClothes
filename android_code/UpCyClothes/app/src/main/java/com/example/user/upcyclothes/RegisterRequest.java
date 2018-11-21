package com.example.user.upcyclothes;


import android.util.Log;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by jinhee on 2018-10-05.
 */

public class RegisterRequest extends StringRequest {

    private Map<String, String> parameters;

    public RegisterRequest(String userID, String userPW, String userName, String nickName, String userType, String zipcode, String addr1, String addr2,
                           String phnNum, String email, String reception, String tag1,String tag2, Response.Listener<String> listener){
        super(Method.POST,  "https://upcyclothes.duckdns.org/android/UserRegister.php", listener, null);
        parameters = new HashMap<>();
        parameters.put("userID", userID);
        parameters.put("userPW", userPW);
        parameters.put("userName", userName);
        parameters.put("nickName", nickName);
        parameters.put("userType", userType);
        parameters.put("zipcode", zipcode);
        parameters.put("addr1", addr1);
        parameters.put("addr2", addr2);
        parameters.put("phnNum", phnNum);
        parameters.put("email", email);
        parameters.put("reception", reception);
        parameters.put("tag1", tag1);
        parameters.put("tag2", tag2);
        Log.v("회원가입정보",userID+userPW+userName+nickName+userType+zipcode+addr1+addr2+phnNum+email+reception+tag1+tag2);

    }
    public RegisterRequest(String userID, String token, Response.Listener<String> listener){

        super(Method.POST,"https://upcyclothes.duckdns.org/android/registerToken.php", listener, null);

        parameters = new HashMap<>();
        parameters.put("user_id", userID);
        parameters.put("token", token);
        Log.v("아이디토큰정보",userID+token);

    }
    @Override
    public Map<String, String> getParams(){
        return parameters;
    }
}