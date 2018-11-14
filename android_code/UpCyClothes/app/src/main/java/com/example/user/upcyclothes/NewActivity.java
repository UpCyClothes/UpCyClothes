package com.example.user.upcyclothes;


import android.content.DialogInterface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import android.content.Intent;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.app.AppCompatActivity;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.GridView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by user on 2018-10-11.
 */

public class NewActivity  extends AppCompatActivity {
    String[] p_id_list;
    String[] p_name_list;
    String[] p_designer_list;
    String[] p_price_list;
    String[] p_url_list;
    String[] p_detailUrl_list;
    String[]  p_quantity_list;

    DisplayMetrics mMetrics;
    View v;
    private String user_ID;


    private GridView.OnItemClickListener gridviewOnItemClickListener
            = new GridView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
            Intent intent = new Intent(NewActivity.this, DetailActivity.class);

            intent.putExtra("category", "accessory");
            intent.putExtra("item id", p_id_list[arg2]);
            intent.putExtra("designer",p_designer_list[arg2]);
            intent.putExtra("item name", p_name_list[arg2]);
            intent.putExtra("item price", p_price_list[arg2]);
            intent.putExtra("item url", p_url_list[arg2]);
            intent.putExtra("item detail url", p_detailUrl_list[arg2]);
            startActivity(intent);
        }
    };

    @Override

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_new);
        if(MainActivity.userID==null){
            //로그인이 필요한 서비스입니다. 창 띄워주기.
            Log.v("userid는  ",user_ID+"없다.");
            new android.app.AlertDialog.Builder(this)
                    .setIcon(android.R.drawable.ic_dialog_alert)
                    .setTitle("알림")
                    .setMessage("로그인이 필요한 서비스입니다.")
                    .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(NewActivity.this, LoginActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    })
                    .show();

        }
        else { //로그인이 되어 있으면.

            user_ID=MainActivity.userID;
            LetsConnect c = new LetsConnect();
            c.getItemInfo();

            GridView gridview = (GridView)findViewById(R.id.gridview);

            GridAdapter adapter = new GridAdapter(this, p_name_list, p_price_list, p_url_list);
            gridview.setAdapter(adapter);

            gridview.setOnItemClickListener(gridviewOnItemClickListener);
            mMetrics = new DisplayMetrics();
            getWindowManager().getDefaultDisplay().getMetrics(mMetrics);
        }




    }

    private class LetsConnect {

        protected void getItemInfo() {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/new4UInfo.php", "user_ID="+user_ID,  false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }

        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요", result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num = root.getString("num_results");
                    p_name_list = new String[Integer.parseInt(num)];
                    p_id_list = new String[Integer.parseInt(num)];
                    p_designer_list=new String[Integer.parseInt(num)];
                    p_price_list = new String[Integer.parseInt(num)];
                    p_url_list = new String[Integer.parseInt(num)];
                    p_detailUrl_list = new String[Integer.parseInt(num)];
                    p_quantity_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        p_id_list[i] = jo.getString("itemID");
                        p_name_list[i] = jo.getString("itemName");
                        p_designer_list[i]=jo.getString("designer");
                        p_price_list[i] = jo.getString("price");
                        p_url_list[i] = "https://upcyclothes.duckdns.org" + jo.getString("URL");
                        p_detailUrl_list[i] = "https://upcyclothes.duckdns.org" + jo.getString("content");
                        p_quantity_list[i]=jo.getString("quantity");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

}
