package com.campusconnect.sit.misc.utils;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentStatePagerAdapter;

import com.campusconnect.sit.R;
import com.campusconnect.sit.ui.fragments.GeneralFragment;
import com.campusconnect.sit.ui.fragments.NoticeFragment;

import java.util.Locale;


public class StudentNoticePager extends FragmentStatePagerAdapter {

    private Context context;

    public StudentNoticePager(Context context, FragmentManager fm) {
        super(fm);
        this.context = context;
    }

    @Override
    public Fragment getItem(int position) {
        switch (position){
            case 0:
                return NoticeFragment.getInstance(true, false, "upload");
            case 1:
                return GeneralFragment.getInstance(true, false);
        }
        return null;
    }

    /**
     * No of fragment
     * @return
     */
    @Override
    public int getCount() {
        return 2;
    }

    /**
     * Title for Tab
     * @param position
     * @return
     */
    @Override
    public CharSequence getPageTitle(int position) {
        Locale locale = Locale.getDefault();
        switch (position){
            case 0:
                return context.getString(R.string.notices).toUpperCase(locale);
            case 1:
                return context.getString(R.string.general).toUpperCase(locale);

        }
        return super.getPageTitle(position);
    }
}
