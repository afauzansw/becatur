import { FilePickerDownload } from "@/components/file-picker-download";
import { Header } from "@/components/header";
import { Button, Card, TextField } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { Setting } from "@/types/setting";
import { useForm } from "@inertiajs/react";
import { IconFile } from "justd-icons";
import { toast } from "sonner";

type SettingProps = {
    setting: Setting;
}

export default function SettingIndex({ setting }: SettingProps) {

    const { data, setData, errors, processing, post, put } = useForm<Setting>(setting);

    const onSubmit = (e: { preventDefault: () => void }) => {
        e.preventDefault();

        post(route('web.backoffice.setting.update'), {
            onError: (err) => {
                toast.error(JSON.stringify(err));
            },
            onSuccess: () => {
                toast.success('Data updated successfully');
            }
        });
    }

    const handleFileChange = (field: keyof Setting, files: FileList | null) => {
        if (files && files[0]) {
            setData(field, files[0] || null);
        } else {
            setData(field, null);
        }
    };

    return (
        <div className="w-full px-6">
            <Header title="Pengaturan" />

            <form onSubmit={onSubmit} className="grid grid-cols-12 gap-4 my-4" >
                <div className="col-span-12" >
                    <Card>
                        <Card.Header>
                        </Card.Header>
                        <Card.Content className="grid grid-cols-12 gap-4" >
                            <TextField
                                className="col-span-6"
                                label="Travel Costs (Rp)"
                                name="travel_costs"
                                value={data.travel_costs}
                                autoComplete="one-time-code"
                                onChange={(v) => setData("travel_costs", v)}
                                errorMessage={errors.travel_costs}
                            />
                            <TextField
                                className="col-span-6"
                                label="Platform Costs (Rp)"
                                name="platform_costs"
                                value={data.platform_costs}
                                autoComplete="one-time-code"
                                onChange={(v) => setData("platform_costs", v)}
                                errorMessage={errors.platform_costs}
                            />
                            <FilePickerDownload
                                label="Qris Image"
                                name="qris_image"
                                value={data?.qris_image}
                                onChange={(files) => handleFileChange("qris_image", files)}
                                accept=".png,.jpg,.jpeg,.gif"
                                prefix={<IconFile />}
                            />
                        </Card.Content>
                        <Card.Footer>
                            <Button intent="custom" isDisabled={processing} type="submit">
                                Submit
                            </Button>
                        </Card.Footer>
                    </Card>
                </div>
            </form>
        </div>

    );
}

SettingIndex.layout = (page: React.ReactNode) => <AppLayout children={page} />;
