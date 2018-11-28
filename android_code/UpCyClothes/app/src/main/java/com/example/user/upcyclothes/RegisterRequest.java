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
        parameters.put("token", "");
        Log.v("회원가입정보",userID+userPW+userName+nickName+userType+zipcode+addr1+addr2+phnNum+email+reception+tag1+tag2);

    }
    public RegisterRequest(String userID,String userPW, String userName,  String zipcode, String addr1, String addr2, String phnNum, String email,
                            String reception, String tag1,String tag2, Response.Listener<String> listener){
        super(Method.POST,  "https://upcyclothes.duckdns.org/android/UserModify.php", listener, null);
        parameters = new HashMap<>();
        parameters.put("userID", userID);
        parameters.put("userPW", userPW);
        parameters.put("userName", userName);
        parameters.put("zipcode", zipcode);
        parameters.put("address1", addr1);
        parameters.put("address2", addr2);
        parameters.put("tel", phnNum);
        parameters.put("Email", email);
        parameters.put("reception", reception);
        parameters.put("tag1", tag1);
        parameters.put("tag2", tag2);
        Log.v("회원정보수정",userPW+userName+zipcode+addr1+addr2+phnNum+email+reception+tag1+tag2);

    }

    public RegisterRequest(String productID, String user_ID, String receiverName, String newAddr1, String newAddr2, String newZipcode, String require, String receiverPhn,String productCount,
                                String date, String productTotPrice, String state, boolean itemType, String itemList,String quantityList,String cartID, Response.Listener<String> listener){

        super(Method.POST,  "https://upcyclothes.duckdns.org/android/OrderRegister.php", listener, null);
        parameters = new HashMap<>();
        if(productID.contains(":")){
            parameters.put("productID", "-1");
            parameters.put("userID", user_ID);
            parameters.put("receiverName", receiverName);
            parameters.put("receiverAddress1", newAddr1);
            parameters.put("receiverAddress2", newAddr2);
            parameters.put("receiverZipcode", newZipcode);
            parameters.put("receiverRequirement", require);
            parameters.put("receiverTel", receiverPhn);
            parameters.put("quantity", "-1");
            parameters.put("date", date);
            parameters.put("totalprice", productTotPrice);
            parameters.put("orderState", state);
            parameters.put("itemType", "0");
            parameters.put("itemList", productID);
            parameters.put("quantityList", productCount);
            parameters.put("cartID", cartID);
        }
        else {
            parameters.put("productID", productID);
            parameters.put("userID", user_ID);
            parameters.put("receiverName", receiverName);
            parameters.put("receiverAddress1", newAddr1);
            parameters.put("receiverAddress2", newAddr2);
            parameters.put("receiverZipcode", newZipcode);
            parameters.put("receiverRequirement", require);
            parameters.put("receiverTel", receiverPhn);
            parameters.put("quantity", productCount);
            parameters.put("date", date);
            parameters.put("totalprice", productTotPrice);
            parameters.put("orderState", state);
            if (itemType) {
                parameters.put("itemType", "1");
            } else parameters.put("itemType", "0");
            parameters.put("itemList", itemList);
            parameters.put("quantityList", quantityList);
            parameters.put("cartID", cartID);
        }
        Log.v("주문정보",productID+user_ID+receiverName+newAddr1+newAddr2+newZipcode+require+receiverPhn+productCount+date+productTotPrice+state+itemType+itemList+quantityList+"cartid="+cartID);

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