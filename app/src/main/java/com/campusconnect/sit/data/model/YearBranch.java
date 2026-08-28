package com.campusconnect.sit.data.model;


public class YearBranch {

    private String yearbranch;
    private boolean isChecked;

    public YearBranch (String yrbranch){
        this.yearbranch = yrbranch;
    }

    public String getYearbranch() {
        return yearbranch;
    }

    public void setYearbranch(String yearbranch) {
        this.yearbranch = yearbranch;
    }

    public boolean isChecked() {
        return isChecked;
    }

    public void setIsChecked(boolean checked){
        isChecked = checked;
    }
}
