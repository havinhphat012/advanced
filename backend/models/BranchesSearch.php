<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Branches;

/**
 * BranchesSearch represents the model behind the search form of `backend\models\Branches`.
 */
class BranchesSearch extends Branches
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'companies_company_id', 'branch_address', 'branch_created_date', 'branch_status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Branches::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // bỏ ghi chú dòng sau nếu bạn không muốn trả lại bất kỳ bản ghi nào khi xác thực không thành công
            // $query->where('0=1');
            return $dataProvider;
        }

        // phương thức joinWith() để thực hiện việc kết nối động thông qua một mối quan hệ companiesCompany trong model
        $query->joinWith('companiesCompany');

        //thiết lập thuộc tính sắp xếp cho dữ liệu được trả về từ câu truy vấn
        $dataProvider->setSort([
            'attributes'=>[
                'branch_name',
                'branch_status',
                'branch_created_date',
                'companies_company_id'=>[
                    'asc'=>['companies.company_name'=>SORT_ASC],
                    'desc'=>['companies.company_name'=>SORT_DESC],
                ]
            ]
        ]);

        // điều kiện lọc lưới
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
            'branch_created_date' => $this->branch_created_date,
        ]);

        //tìm kiếm cho các trường trong bảng "branches" và bảng "companies"
        $query->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'branch_address', $this->branch_address])
            ->andFilterWhere(['like', 'branch_status', $this->branch_status])
            ->andFilterWhere(['like', 'companies.company_name', $this->companies_company_id]);

        return $dataProvider;
    }
}

