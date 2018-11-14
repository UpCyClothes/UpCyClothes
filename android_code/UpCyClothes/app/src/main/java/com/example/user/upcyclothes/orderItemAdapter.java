package com.example.user.upcyclothes;


import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;


public class orderItemAdapter extends BaseAdapter {
    private Context context;

    private String[] orderID;
    private String[] orderDate;
    private String[] orderURL;
    private String[] itemID;
    private String[] itemName;
    private String[] itemPrice;
    private String[] itemAmount;

    public  orderItemAdapter (Context con, String[] s1, String[] s2,String[] s3, String[] s4,String[] s5, String[] s6){
        this.context=con;

        this.orderID=s1;
        this.orderDate=s2;
        this.orderURL=s3;
        this.itemName=s4;
        this.itemPrice=s5;
        this.itemAmount=s6;
    };
    @Override
    public int getCount() {
        return itemName.length;
    }

    @Override
    public String[] getItem(int pos){
        String[] item= new String[5];
        item[0]=orderID[pos];
        item[1]=orderDate[pos];
        item[2]=orderURL[pos];
        item[3]=itemName[pos];
        item[4]=itemPrice[pos];
        item[5]=itemAmount[pos];
        return item;
    }

    @Override
    public  long getItemId(int pos){
        return pos;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(convertView == null){
            convertView= new orderItem(context);
        }
        ((orderItem)convertView).setData(orderID[position],orderDate[position],orderURL[position],itemName[position],itemPrice[position],itemAmount[position]);
        return convertView;
    }
}
