package com.example.user.upcyclothes;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MaterialActivity extends AppCompatActivity {
    String[] m_name_list;
    String[] m_url_list;
    String[] remain_amount_list;
    DisplayMetrics mMetrics;
    View v;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_material);
        LetsConnect c = new LetsConnect();
        c.getItemInfo();
        //이미지 다 받으면

        GridView gridview = (GridView)findViewById(R.id.gridview);
        GridView.OnItemClickListener gridviewOnItemClickListener
                = new GridView.OnItemClickListener() {

            public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                    long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
                Intent intent = new Intent(MaterialActivity.this, DetailMaterial.class);

                intent.putExtra("item name",m_name_list[arg2]);
                intent.putExtra("item url",m_url_list[arg2]);
                intent.putExtra("item remain amount",remain_amount_list[arg2]);
                startActivity(intent);
            }
        };


        GridAdapter adapter= new GridAdapter(this,m_name_list,m_url_list);
        gridview.setAdapter(adapter);

        gridview.setOnItemClickListener(gridviewOnItemClickListener);
        mMetrics = new DisplayMetrics();

    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/MaterialInfo.php", "category=0",false);

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

            Log.v("이제 재고아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    m_name_list=new String[Integer.parseInt(num)];
                    m_url_list=new String[Integer.parseInt(num)];
                    remain_amount_list=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        m_name_list[i]=jo.getString("materialName");
                        m_url_list[i]="https://upcyclothes.duckdns.org"+jo.getString("URL");
                        remain_amount_list[i]=jo.getString("material_Quantity");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
