package com.example.user.upcyclothes;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class messAdapter extends BaseAdapter {

    private String[] itemName;
    private boolean[] unread;

    messAdapter(String[] s1,boolean[] s2) {
        this.itemName= s1;
        this.unread=s2;
    }

    @Override
    public int getCount() {
        return itemName.length;
    }

    @Override
    public String[] getItem(int position) {
        String[] item= new String[2];
        item[0]=itemName[position];
        item[1]=unread[position]+"";
        return item;
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        Context context = parent.getContext();

        /* 'listview_custom' Layout을 inflate하여 convertView 참조 획득 */
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.messitem, parent, false);
        }

        /* 'listview_custom'에 정의된 위젯에 대한 참조 획득 */
        TextView nameTV = (TextView) convertView.findViewById(R.id.nameTV);
        ImageView newBtn= (ImageView) convertView.findViewById(R.id.newBtn);



        /* 각 위젯에 세팅된 아이템을 뿌려준다 */
        nameTV.setText(itemName[position]);
        if(unread[position]){
            newBtn.setVisibility(View.VISIBLE);
        }

        return convertView;
    }


}