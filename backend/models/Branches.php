<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $branch_id
 * @property int $companies_company_id
 * @property string $branch_name
 * @property string $branch_address
 * @property string $branch_created_date
 * @property string $branch_status
 *
 * @property Departments $branch
 * @property Companies $companies
 * @property Departments[] $companies0
 * @property Companies $companiesCompany
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    // xác thực và xử lý dữ liệu của đối tượng model
    public function rules()
    {
        return [
            [['companies_company_id', 'branch_name', 'branch_address', 'branch_created_date', 'branch_status'], 'required'],
            [['companies_company_id'], 'integer'],
            [['branch_created_date'], 'safe'],
            [['branch_status'], 'string'],
            ['branch_name', 'unique'],
            ['branch_status', 'required', 'when' => function ($model) {
                return (!empty($model->branch_address)) ? true : false;
            }, 'whenClient' => "function(){
                if ($('#branch_address').val() === undefined)
                {
                    false;
                }else{
                    true;
                    }
                }"],
            [['branch_name'], 'string', 'max' => 100],
            [['branch_address'], 'string', 'max' => 255],
            // thuộc tính companies_company_id phải tồn tại trong bảng "companies" và trỏ tới cột "company_id"
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['companies_company_id' => 'company_id']],
            //thuộc tính branch_id phải tồn tại trong bảng "departments" và trỏ tới cột "department_id"
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::class, 'targetAttribute' => ['branch_id' => 'department_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'companies_company_id' => 'Companies Name',
            'branch_name' => 'Branch Name',
            'branch_address' => 'Branch Address',
            'branch_created_date' => 'Branch Created Date',
            'branch_status' => 'Branch Status',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        //định nghĩa mối quan hệ giữa bảng "branches" và bảng "departments"
        return $this->hasOne(Departments::class, ['department_id' => 'branch_id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        //định nghĩa mối quan hệ giữa bảng "branches" và bảng "companies"
        return $this->hasOne(Companies::class, ['company_id' => 'branch_id']);
    }

    /**
     * Gets query for [[Companies0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies0()
    {
        //định nghĩa mối quan hệ giữa bảng "branches" và bảng "departments" thông qua bảng trung gian "companies"
        return $this->hasMany(Departments::class, ['department_id' => 'company_id'])->viaTable('companies', ['company_id' => 'branch_id']);
        //Phương thức viaTable() được sử dụng để xác định tên của bảng trung gian và các cặp giá trị khóa trong bảng trung gian để thiết lập mối quan hệ giữa hai bảng
    }

    /**
     * Gets query for [[CompaniesCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        //định nghĩa mối quan hệ giữa bảng "branches" và bảng "companies"
        return $this->hasOne(Companies::class, ['company_id' => 'companies_company_id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        //định nghĩa mối quan hệ giữa bảng "branches" và bảng "departments"
        return $this->hasMany(Departments::class, ['branches_branch_id' => 'branch_id']);
    }
}
