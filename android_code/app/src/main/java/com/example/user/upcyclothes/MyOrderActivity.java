package com.example.user.upcyclothes;

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
import android.widget.ListAdapter;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by user on 2018-10-11.
 */

public class MyOrderActivity  extends AppCompatActivity {
    String[] p_id_list;
    String[] p_name_list;
    String[] p_price_list;
    String[] p_url_list;
    String[] p_detailUrl_list;

    //static ArrayList<String> sauce_list = new ArrayList<>();
    //private Integer[] mThumbIds;

    DisplayMetrics mMetrics;
    View v;

    public MyOrderActivity(){
        LetsConnect c = new LetsConnect();
        c.getItemInfo();

    }

    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
            Intent intent = new Intent(MyOrderActivity.this, DetailActivity.class);

            intent.putExtra("category","accessory");
            intent.putExtra("item id",p_id_list[arg2]);
            intent.putExtra("item name",p_name_list[arg2]);
            intent.putExtra("item price",p_price_list[arg2]);
            intent.putExtra("item url",p_url_list[arg2]);
            intent.putExtra("item detail url",p_detailUrl_list[arg2]);
            startActivity(intent);
        }
    };
    @Override

    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_order);
        ListView listView = (ListView) findViewById(R.id.listview);

        listAdapter adapter= new listAdapter(this,p_name_list,p_price_list);
        listView.setAdapter(adapter);

        listView.setOnItemClickListener(listviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        getWindowManager().getDefaultDisplay().getMetrics(mMetrics);



    }

    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/imageInfo.php", "category=3",false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    p_name_list=new String[Integer.parseInt(num)];
                    p_id_list=new String[Integer.parseInt(num)];
                    p_price_list=new String[Integer.parseInt(num)];
                    p_url_list=new String[Integer.parseInt(num)];
                    p_detailUrl_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        p_id_list[i]=jo.getString("productID");
                        p_name_list[i]=jo.getString("productName");
                        p_price_list[i]=jo.getString("price");
                        p_url_list[i]="https://upcyclothes.duckdns.org"+jo.getString("URL");
                        p_detailUrl_list[i]="https://upcyclothes.duckdns.org"+jo.getString("content");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }


}
